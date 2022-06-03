<h1>Получение событий</h1>

**Route:** <code>/api/news/get-events</code>
<br>
<br>
**Params:**
<table>
<thead>
    <th>Key</th>
    <th>Type</th>
</thead>
<tbody>
    <tr>
        <td>dateFrom</td>
        <td>int | timestamp</td>
    </tr>
    <tr>
        <td>dateTo</td>
        <td>int | timestamp</td>
    </tr>
</tbody>    
</table>

**Пример ответа:**
<pre>
[
    {
        "id": "30338",
        "title": "Донецкий ботанический сад проведёт дегустацию папайи",
        "content": "< html-разметка >",
        "photo": "/media/upload/novosti/novosti_goroda/papaya1.jpg",
        "coordinates": "[51.505, -0.09]", // Строка
        "event_time": "1656536400",
        "type": "Обстрел"
    },
    {
        "id": "30438",
        "title": "Example Title",
        "content": "< html-разметка >",
        "photo": "/media/upload/novosti/novosti_goroda/some_pic.jpg",
        "coordinates": "[54.404, -3.116]", // Строка
        "event_time": "1655845200",
        "type": "Несчастный случай"
    }
]
</pre>