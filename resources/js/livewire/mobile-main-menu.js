document.getElementById('main-menu-sidebar-active').addEventListener('change', function (e)
{
	// No scroll when main menu sidebar is open
	if (e.target.checked)
		document.body.style.overflowY = 'hidden';
	else
		document.body.style.overflowY = 'auto';
});
