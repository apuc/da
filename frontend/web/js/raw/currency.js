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
            var style = 'green';
            var td;
            if(parseInt(response[5]) < 0)
                style = 'red';
            switch (response[0]) {
                case BTCUSD: td = $('td:contains("Bitcoin (BTC)")').next(); break;
                case BTCEUR: td = $('td:contains("Bitcoin (BTC)")').next().next(); break;
                case LTCUSD: td = $('td:contains("Litecoin (LTC)")').next(); break;
                case ETHUSD: td = $('td:contains("Ethereum (ETH)")').next(); break;
                case ETHEUR: td = $('td:contains("Ethereum (ETH)")').next().next(); break;
            }
            td.css('color', style);
            td.html(response[3]);
        }
    };
});

