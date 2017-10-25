function Calendar(table, searchForm) {
    Container.call(this, 'calendar');
    this.table = table;                 //Сюда вставляем календарь
    this.searchForm = searchForm;       //Переключалка дат
    this.month = '';                    //месяц для которого отображаем
    this.monthNames = [];               //Текстовые названия месяцев
    this.year = '';                     //год для которого отображаем
    this.rows = [];                     //Получаем список рядов

    Calendar.prototype = Object.create(Container.prototype);
    Calendar.prototype.constructor = Calendar;

    this.getDateParams();               //нужно получить данные
    this.getMonthNames();               //получаем массив имён месяцев
    this.init();                        //запускаем компонент
    this.searchForm.onchange = function ()
    {
        this.init();
    }.bind(this)
}


//Получаем данные о текущем месяце из input type="month"
Calendar.prototype.getDateParams = function () {
    var date = this.searchForm.value.split('-');
    this.year = date[0];
    this.month = date[1];
};

//Делаем запрос в БД на тему дней и задач в них
Calendar.prototype.requestTasks = function (callback) {

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../my/tasks' + '?year=' + this.year + '&month=' + this.month, true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send();

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {

            this.parseResponse(xhr);    //парсим ответ
            this.renderCalendar();      //рисуем календарь
        }
    }.bind(this);
};


// Делаем красивую сетку из TD-шек
Calendar.prototype.highlightGrid = function () {
    var rows = document.getElementsByTagName('td');
    for (var i = 0; i < rows.length; i++) {

        if (i % 2 == 0) {
            //По какой-то неведомой мне причине через (i) работает, а через [i] (как и должно быть, по идее) нет О____о
            //noinspection JSAnnotator
            rows.item(i).classList += " tasks-table__day--darken"
        }
    }
};

// Старт компонента
Calendar.prototype.init = function () {
    this.getDateParams();
    this.requestTasks(      // Запросили данные о днях и задачах у сервера
        this.parseResponse  // Передали колбэк
    );
};

Calendar.prototype.parseResponse = function (xhr) {
    var response = JSON.parse(xhr.responseText);       //забираем в response что нам ответил сервер
    var firstDayCount = response.firstDayCount;         //Номер первого дня в неделе
    var daysInMonth = response.daysInMonth;             //Сколько всего дней в этом месяце

    var cellsAmount = 42;                               //кол-во ячек в календаре
    var row = [];
    var k = 0;                                          //счётчик дней (не пустых ячеек)
    var rowNumber = 0;                                  //номер ряда
    var dayNumber = 0;                                  //номер дня в ряду

    for (var j = 0; j <= cellsAmount; j++) {
        if (j % 7 == 0 && j != 0)                          //Каждый 7й день создаём новый ряд и обнуляем счётчики
        {
            this.rows[rowNumber] = new CalendarRow(row);
            row = [];
            dayNumber = 0;
            rowNumber++;
        }
        if (j < firstDayCount || k >= daysInMonth) {       //тут мы делаем пустые ячейки (можно бы сделать и другие месяца)
            row[dayNumber] = new CalendarDay(null);
        }
        else {
            response.days[k]['dayCount'] = k+1;            //пишем номер дня в данные
            row[dayNumber] = new CalendarDay(response.days[k]);
            k++;
        }
        dayNumber++;

    }
};

// Отрисовываем календарь
Calendar.prototype.renderCalendar = function () {
    var body = document.createElement('tbody');
    var output = '';
    for (var i = 0; i < this.rows.length; i++) {
        output += '<tr>';
        for (var j = 0; j < this.rows[i].days.length; j++)
        {
            output += this.rows[i].days[j].print(this.monthNames);      //немного мудрёный массив получился, сам еле разобрался =)
        }
        output += '</tr>';
    }
    body.innerHTML = output;
    this.table.innerHTML = '';
    this.table.appendChild(body);
    this.highlightGrid();               //подсвечиваем сетку в "шахматном" виде.
};

//Задаём имя месяца
Calendar.prototype.getMonthNames = function ()
{
    var date = new Date(this.year, this.month-1, 1);
    var months = ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн', 'Июл', 'Авг', 'Сент', 'Окт', 'Ноя', 'Дек'];
    this.monthNames = months[date.getMonth()];
};