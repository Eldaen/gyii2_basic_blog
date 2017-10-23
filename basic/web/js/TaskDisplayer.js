function TaskDisplayer(elem, data)
{
    this.elem = elem;
    this.data = data;

    this.draw = function ()
    {
        var firstP = document.createElement('p');
        firstP.innerText = data.name;
        elem.appendChild(firstP);

        var secondP = document.createElement('p');
        secondP.classList = 'small';
        secondP.innerText = 'data.description';
        elem.appendChild(secondP);

    }
}