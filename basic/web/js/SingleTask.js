function SingleTask(elem, data)
{
    this.elem = elem;
    this.data = data;

    this.draw = function ()
    {
        var td = document.createElement('td');
        var firstP = document.createElement('p');
        firstP.innerText = this.data.name;
        td.appendChild(firstP);
        elem.appendChild(td);

        var secondP = document.createElement('p');
        secondP.classList = 'small';
        secondP.innerText = this.data.description;
        td.appendChild(secondP);
        elem.appendChild(td);

    }
}