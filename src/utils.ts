import Types from "./types";

export const redirect = (path: string) => {
	const newPath = window.location.pathname + "/../" + path;
	console.log(newPath);
	window.location.replace(newPath);
};

export const getRandomNumber = (min: number, max: number): number => {
	return Math.floor(Math.random() * (max - min - 1) + min);
};

export const createLoginResultElement = (
	status: Types.LoginStatus,
	innerHTML: string
) => {
	const parentTag = "section";
	const childTag = "span";
	const parent = document.getElementsByTagName(parentTag)[0];
	const child = document.createElement(childTag);
	child.innerHTML = innerHTML;
	if (status == "success") {
		child.classList.add("login", "successful-login");
	} else {
		child.classList.add("login", "wrong-login");
	}
	parent.appendChild(child);
};

export const removeElementsByClassName = (className: string) => {
	const elements = document.getElementsByClassName(className);
	for (let i = 0; i < elements.length; i++) {
		elements[i].remove();
	}
};

export const insertHTMLById = (elementId: string, innerHTML: string) => {
	const element = document.getElementById(elementId);
	element.innerHTML = innerHTML;
};

const labels = [
	"Wygląd strony",
	"Interfejs",
	"Formularz",
	"Wybieranie trudności",
	"Logowanie",
	"Galeria",
];

export const checkBoxLabels = (fieldsetId: string) => {
	let html = "<legend> <h2>Kategorie problemu:</h2> </legend>\n";
	for (let i = 0; i < labels.length; i++) {
		html += `<label for="checkbox-${i}">${labels[i]}</label>\n<input type="checkbox" name="checkbox-${i}" id="checkbox-${i}">\n`;
	}
	insertHTMLById(fieldsetId, html);
};

export const returnCheckedLabels = () => {
	let labelsText = "";
	for (let i = 0; i < labels.length; i++) {
		const checkboxTag = `#checkbox-${i}`;
		const checked = $(checkboxTag).is(":checked");
		if (checked) {
			labelsText += labels[i].toString() + ", ";
		}
	}
	if(labelsText.length > 0) {
		labelsText = labelsText.substring(0, labelsText.length - 2);
	}
	return labelsText;
};
