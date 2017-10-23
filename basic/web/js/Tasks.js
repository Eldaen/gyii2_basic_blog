function Tasks(elem)
{
    this.elem = elem;

    this.requestTasks = function (callback, basket) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', './my/index2', true);
        xhr.send();

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {

                callback.apply(xhr);
            }
        };
    };

    this.render = function () {


        this.requestTasks(
            function() {

                for (var i; i < this.responseText.length; i++)
                {
                    var date = new Date(this.responseText[i].date);
                    var day = date.getDay();

                    var tr = document.createElement('tr');
                    var td = document.createElement('td');
                    td.classList = 'td-date';
                    td.appendChild(td);

                    var span = document.createElement('span');
                    span.classList = 'label label-success';
                    span.innerText = day;
                    td.appendChild(span);

                    for (var j; j < this.responseText[i].length; j++)
                    {
                        var task = new TaskDisplayer(td, this.responseText[i]);
                        task.draw();
                    }
                }
                elem.innerHTML = this.responseText;
            }
        )
    };
}