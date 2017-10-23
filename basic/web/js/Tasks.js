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
            }
        };
    };

    this.render = function () {
        elem.innerText = '';
        this.requestTasks(
            function() {
                var days = JSON.parse(this.responseText);

                for (var i = 0; i < days.length; i++)
                {
                    var tr = document.createElement('tr');
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
                    elem.appendChild(tr);
                }

            }
        )
    };

    this.getDataParams = function ()
    {
        return this.form.value.split('-');
    }
}