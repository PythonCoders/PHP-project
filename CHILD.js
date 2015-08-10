function getRadioValue(theRadioGroup)
{
    var elements = document.getElementsByName(theRadioGroup);
    for (var i = 0, l = elements.length; i < l; i++)
    {
        if (elements[i].checked)
        {
            return elements[i].value;
        }
    }
}




function ComputeTotalChild()
{
	var tmp, val;
	var opt2 = 0;
	var opt1 = 0;
	var opt3 = 0;
	var opt4 = 0;
	var index = new Array("Q1", "Q2", "Q3", "Q4", "Q5", "Q6", "Q7", "Q8", "Q9");
	var i = 0;
	for(i=0; i<index.length; i++)
	{
		val = getRadioValue(index[i]);
		if(val == 0)
			opt1 += 0;
		else if(val == 1)
			opt2 += 1;
		else if(val ==2)
			opt3 += 2;
		else
			opt4 += 3;
	}
	var sum;
	sum = opt1 + opt2 + opt3 + opt4;

	
	document.getElementById('total').value = sum;
}
