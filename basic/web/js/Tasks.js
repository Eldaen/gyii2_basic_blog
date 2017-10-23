function Tasks(elem, form)
{
    this.elem = elem;
    this.form = form;

    this.requestTasks = function (callback) {
        var searchParams = this.getDataParams();

        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../my/tasks'+'?year=' + searchParams[0] + '&month=' + searchParams[1], true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send();

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                callback.apply(xhr);

                var rows = document.getElementsByTagName('td');
                for (var i = 0; i < rows.length; i++) {

                    if (i % 2 == 0) {
                        //noinspection JSAnnotator
                        rows.item(i).classList += " tasks-table__day--darken"
                    }
                }
            }
        };
    };

    this.render = function () {
        this.requestTasks(
            function() {
                var response = JSON.parse(this.responseText);
                var result = '';

                var date = new Date(response.year, response.month-1, 1);
                var months = ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сент', 'Окт', 'Ноя', 'Дек'];
                var monthName = months[date.getMonth()];
                var lastDayPosition = parseInt(response.daysInMonth) + parseInt(response.firstDayCount);



                for (var i = 0; i < 42; i++)
                {
                    if(i == 0) result += '<tr>';
                    if(i%7 == 0 && i != 0) result += '</tr><tr>';
                    if(i == 42) result += '</tr>';

                    if(i < response.firstDayCount || (i >= lastDayPosition && i < 42))
                    {
                        result += '<td class="tasks-table__day"></td>';
                        continue;
                    }
                    if(response.days[i-response.firstDayCount].length)
                    {
                        result += '<td class="tasks-table__day">';
                        result += '<span class="tasks-table__date">' + (i-response.firstDayCount) +' ' + monthName + '.</span>';
                        for (var j = 0; j < response.days[i-response.firstDayCount].length; j++)
                        {
                            result += '<a class="task-table__link" href="../my/events?date=' + response.days[i-response.firstDayCount][0].date + '">' + response.days[i-response.firstDayCount][0].name + '</a>';
                        }
                        continue;
                    }

                    result += '<td class="tasks-table__day">';
                    result += '<span class="tasks-table__date">' + (i+1-response.firstDayCount) +' ' + monthName + '.</span></td>';
                   /* var tr = document.createElement('tr');
                    var date = new Date(days[i].date);
                    var day = date.getDay();

                    var td = document.createElement('td');
                    td.classList = 'td-date';
                    tr.appendChild(td);

                    var span = document.createElement('span');
                    span.classList = 'label label-success';
                    span.innerText = i;
                    td.appendChild(span);

                    for (var j = 0; j < days[i].length; j++)
                    {
                        var task = new SingleTask(tr, days[i][j]);
                        task.draw();
                    }

                    if(days[i].length > 0)
                    {
                        var count = document.createElement('td');
                        count.classList = 'td-event';
                        count.innerText = days[i].length;
                        tr.appendChild(count);
                    }
                    elem.appendChild(tr);*/
                }
                elem.innerHTML = result;
            });
    };

    this.getDataParams = function ()
    {
        return this.form.value.split('-');
    };

    this.getMonthNames = function (val)
    {
        var months = ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сент', 'Окт', 'Ноя', 'Дек'];
        return months[val];
    }
}