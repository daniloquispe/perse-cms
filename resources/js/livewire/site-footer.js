const footerMenus = document.querySelectorAll('.footer-menu-box nav .title');

footerMenus.forEach(function (title)
{
	const menuId = title.dataset.menu;
	if (menuId === undefined)
		return;

	title.addEventListener('click', function ()
	{
		console.log('Menu ID:', menuId);

		const submenu = document.querySelector(`ul[data-menu="${menuId}"]`);
		console.log('Submenu:', submenu);

		title.classList.toggle('open');
		submenu.classList.toggle('open');
	});
});
