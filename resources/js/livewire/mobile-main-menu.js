const mobileMenuButtons = document.querySelectorAll('.with-scroll');
const mobileMenuContainer = document.querySelector('.level-cols');

mobileMenuButtons.forEach(function (button)
{
	button.addEventListener('click', function (e)
	{
		const level = parseInt(e.target.dataset.level);
		// console.log('Level: ' + level);
		const idToShow = parseInt(e.target.dataset.show);
		console.log('ID to show: ' + idToShow);

		const currentLevel = mobileMenuContainer.dataset.level;
		const goBack = level < currentLevel;
		// const newLevel = level < currentLevel ? level : level + 1;
		const newLevel = goBack ? level : level + 1;

		// console.log(`From level ${currentLevel} to ${newLevel}`);

		// Scroll effect
		/*if (newLevel === 3)
			target.style.translateX = '-66.66666%';
		else if (newLevel === 2)
			target.style.translateX = '-33.33333%';*/
		if (currentLevel > 1 || newLevel > 1)
		{
			mobileMenuContainer.classList.remove('in-level-' + currentLevel);
			mobileMenuContainer.classList.add('in-level-' + newLevel);
		}
		else
			console.log('Nothing to do here :(');

		mobileMenuContainer.dataset.level = newLevel;

		// For non-top levels, show selected options list
		if (newLevel !== 1 && idToShow !== undefined && !goBack)
		{
			const newLevelContainers = document.querySelectorAll('.level-col-' + newLevel + ' > .can-show');

			newLevelContainers.forEach(function (container)
			{
				console.log(container.dataset.id);

				if (idToShow == container.dataset.id)
					container.classList.add('show');
				else
					container.classList.remove('show');
			});
		}
	});
});

document.getElementById('main-menu-sidebar-active').addEventListener('change', function (e)
{
	// No scroll when main menu sidebar is open
	if (e.target.checked)
		document.body.style.overflowY = 'hidden';
	else
		document.body.style.overflowY = 'auto';
});
