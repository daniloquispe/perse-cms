document.getElementById('cart-sidebar-active').addEventListener('change', function (e)
{
	// No scroll when cart sidebar is open
	if (e.target.checked)
		document.body.style.overflowY = 'hidden';
	else
		document.body.style.overflowY = 'auto';
});
