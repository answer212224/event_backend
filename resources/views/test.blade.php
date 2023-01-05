<x-guest-layout>

    <form name='Newebpay' method='post' action='https://ccore.newebpay.com/MPG/mpg_gateway'>
        MerchantID<input type='text' name='MerchantID' value={{ $mid }} /><br>
        TradeInfo<input type='text' name='TradeInfo' value={{ $edata1 }} /><br>
        Tradehash<input type='text' name='TradeSha' value={{ $hash }} /><br>
        TradeVersion<input type='text' name='Version' value=2.0 /><br>

        <input type='submit' value='Submit'>
    </form>

</x-guest-layout>
