/**
 * Testing whether JavaScript modules and call APIs work
 */
function fetchTasks () {
	const xhr = new XMLHttpRequest();
	xhr.open('GET', 'http://localhost/dev/MVC/api/tasks');

	xhr.onreadystatechange = function () {
		if (this.readyState === 4 && this.status === 200) {
			const data = JSON.parse(this.responseText);
			const { tasks } = data;
			tasks.forEach((task) => {
				console.debug(task);
			});
		}
	};

	xhr.send();
};

window.onload = () => {
	fetchTasks();
};
