function CalendarDay(data)
{
    this.data = data;
}

CalendarDay.prototype.print = function(month)
{
    var result = '';
    result += '<td class="tasks-table__day">';
    if(this.data)
    {
        result += '<span class="tasks-table__date">'+ (this.data.dayCount) +' ' + month + '.</span>';
        if(this.data.length)
        {
            if(this.data.length == 1)
            {
                result += '<a class="task-table__link" href="../my/events?date=' + this.data[0].date + '">' + this.data[0].name + '</a>';
            } else {
                result += '<a class="task-table__link" href="../my/events?date=' + this.data[0].date + '">' + 'Количество задач: ' + this.data.length + '</a>';
            }
        }
    }
    result += '</td>';
    return result;
};