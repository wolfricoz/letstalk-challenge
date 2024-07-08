<?php

namespace App\Console\Commands;

use App\Models\Conversions;
use App\Models\Currency;
use DOMDocument;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class UpdateCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public $currencyLocations = [];

    private function addCurrencyToCurrency(array $currencyresponse): void
    {
        foreach ($currencyresponse as $currency) {
            $currencyName = strtolower($currency['code']);
            $currencyExists = Currency::where('name', '=', $currencyName)->first();
            if ($currencyExists) {
                $this->currencyLocations[strtolower($currencyExists->name)] = $currencyExists->id;
            }
            if (!$currencyExists) {
                $entry = Currency::create(['name' => ($currencyName)]);
                $this->currencyLocations[$entry->name] = $entry->id;
            }
        }


    }

    private function addConversionToCurrency($currencyresponse, $name)
    {
        if (!$currencyresponse) {
            echo "Currency response is Null for" . $name;
            return;
        }


        if (!array_key_exists($name, $this->currencyLocations)) {
            echo $name . PHP_EOL;
            $entry = Currency::create(['name' => $name]);
            $this->currencyLocations[$entry->name] = $entry->id;
        }
        foreach ($currencyresponse as $currency) {
            $currencyName = strtolower($currency['code']);
            if (!array_key_exists($currencyName, $this->currencyLocations)) {
                $entry = Currency::create(['name' => $currencyName]);
                $this->currencyLocations[$entry->name] = $entry->id;
            }
            $entry = Conversions::where('from_currencies_id', '=', $this->currencyLocations[$name])->where('to_currencies_id', '=', $this->currencyLocations[$currencyName])->first();
            if ($entry) {
                $entry->update(['rate' => $currency['rate']]);
                continue;
            }


            Conversions::create([
                'from_currencies_id' => $this->currencyLocations[$name],
                'to_currencies_id' => $this->currencyLocations[$currencyName],
                'rate' => $currency['rate'],
                'name' => $currencyName
            ]);
        }


    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
//      This gets the webpage and parses it for all the urls.
        $response = Http::get('https://www.floatrates.com/json-feeds.html');
        $dom = new DOMDocument();
        @$dom->loadHTML($response->body());
        $links = $dom->getElementsByTagName('a');
        $urls = [];
        foreach ($links as $link) {
            $urls[] = $link->getAttribute('href');

        }
//      This removes any url which does not end with .json
        $first = false;
        foreach ($urls as $key => $url) {
            $endswithjson = str_ends_with($url, '.json');
            if (!$endswithjson) {
                unset($urls[$key]);
                continue;
            }
            $name = explode('/', $url);
            $name = strtolower(substr(end($name), 0, -5));
            if ($endswithjson && !$first) {
                $first = true;
                $currencyresponse = Http::get($url)->json();
                $currencyresponse[$name] = ['code' => $name];
                // This adds the currency to the currency table
                $this->addCurrencyToCurrency($currencyresponse);
            }
            if ($endswithjson) {
                $currencyresponse = Http::get($url)->json();
                if (!$currencyresponse) {
                    continue;
                }
                // This adds conversion data to the conversion table
                $this->addConversionToCurrency($currencyresponse, $name);
            }
            $this->info("$name has been processed");

        }
        $this->info('The currencies have been updated');

    }
}
