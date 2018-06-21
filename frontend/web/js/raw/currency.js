$(document).ready(function () {

    const socket = new WebSocket("wss://api.bitfinex.com/ws");

    var BTCUSD, BTCEUR, LTCUSD, ETHUSD, ETHEUR;

    socket.onopen = function () {
        socket.send(JSON.stringify({"event": "subscribe", "channel": "ticker", "pair": "BTCUSD"}));
        socket.send(JSON.stringify({"event": "subscribe", "channel": "ticker", "pair": "BTCEUR"}));
        socket.send(JSON.stringify({"event": "subscribe", "channel": "ticker", "pair": "LTCUSD"}));
        socket.send(JSON.stringify({"event": "subscribe", "channel": "ticker", "pair": "ETHUSD"}));
        socket.send(JSON.stringify({"event": "subscribe", "channel": "ticker", "pair": "ETHEUR"}));
    };

    socket.onmessage = function (msg) {
        var response = JSON.parse(msg.data);
        if (response.event === "subscribed") {
            switch (response.pair) {
                case "BTCUSD": BTCUSD = response.chanId; break;
                case "BTCEUR": BTCEUR = response.chanId; break;
                case "LTCUSD": LTCUSD = response.chanId; break;
                case "ETHUSD": ETHUSD = response.chanId; break;
                case "ETHEUR": ETHEUR = response.chanId; break;
            }
        }
        else if (!response.event && response[1] !== 'hb') {
            switch (response[0]) {
                case BTCUSD: $('td:contains("Bitcoin (BTC)")').next().html(response[3]); break;
                case BTCEUR: $('td:contains("Bitcoin (BTC)")').next().next().html(response[3]); break;
                case LTCUSD: $('td:contains("Litecoin (LTC)")').next().html(response[3]); break;
                case ETHUSD: $('td:contains("Ethereum (ETH)")').next().html(response[3]); break;
                case ETHEUR: $('td:contains("Ethereum (ETH)")').next().next().html(response[3]); break;
            }
        }
    };
});

