import { redirect } from "../utils";
import Constants from "../constants";

const convertDifficulty = (difficulty: string): string => {
	let difficultyTranslated = "easy";
	switch (difficulty) {
		case "Łatwy": {
			difficultyTranslated = Constants.DifficultyLevel.Easy;
			break;
		}
		case "Średni": {
			difficultyTranslated = Constants.DifficultyLevel.Medium;
			break;
		}
		case "Trudny": {
			difficultyTranslated = Constants.DifficultyLevel.Hard;
			break;
		}
		case "Bardzo Trudny": {
			difficultyTranslated = Constants.DifficultyLevel.Impossible;
			break;
		}
	}
	return difficultyTranslated;
};

const startWebpage = () => {
	const selectmenuTag = "#difficulty";
	const difficulty = localStorage.getItem(Constants.Key.Difficulty);
	let difficultyTranslated = "Łatwy";
	switch (difficulty) {
		case Constants.DifficultyLevel.Easy: {
			difficultyTranslated = "Łatwy";
			break;
		}
		case Constants.DifficultyLevel.Medium: {
			difficultyTranslated = "Średni";
			break;
		}
		case Constants.DifficultyLevel.Hard: {
			difficultyTranslated = "Trudny";
			break;
		}
		case Constants.DifficultyLevel.Impossible: {
			difficultyTranslated = "Bardzo Trudny";
			break;
		}
	}
	$(selectmenuTag).selectmenu();
	$(selectmenuTag).val(difficultyTranslated);
	$(selectmenuTag).selectmenu("refresh");
	const buttonTag = "input[type=submit]";
	$(buttonTag).button();
	$(buttonTag).on("click", (event: JQuery.ClickEvent) => {
		event.preventDefault();
		const difficulty = convertDifficulty(
			$(selectmenuTag).find(":selected").text()
		);
		localStorage.setItem(Constants.Key.Difficulty, difficulty);
		redirect(Constants.Webpage.Login);
	});
};

export default startWebpage;
