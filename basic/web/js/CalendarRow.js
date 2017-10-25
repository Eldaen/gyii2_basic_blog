function CalendarRow(days)
{
    this.days = days; // Тут должен быть список объектов типа CalendarDay

    CalendarRow.prototype.constructor = Object.create(Container.constructor);
    CalendarRow.prototype.constructor = CalendarRow;
}
