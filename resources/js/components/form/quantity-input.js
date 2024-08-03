let control = document.querySelector('.component--quantity-input');

if (control !== null)
{
	function increment(step)
	{
		let currentValue = parseInt(control.querySelector('.input').value);

		currentValue += step;

		if (currentValue >= 1)
			control.querySelector('.input').value = currentValue;
	}

	control.querySelector('.dec').onclick = () => increment(-1);
	control.querySelector('.inc').onclick = () => increment(1);
}
