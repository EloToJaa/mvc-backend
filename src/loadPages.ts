import Constants from "./constants";
import bugWebpage from "./page/bug";
import difficultyWebpage from "./page/difficulty";
import loginWebpage from "./page/login";
import startWebpage from "./page/start";

const pageLoad = () => {
	const path = window.location.pathname;
	const page = path.split("/").pop().split(".")[0];
	switch (page) {
		case Constants.Webpage.Bug: {
			bugWebpage();
			break;
		}
		case Constants.Webpage.Login: {
			loginWebpage();
			break;
		}
		case Constants.Webpage.Start: {
			startWebpage();
			break;
		}
		case Constants.Webpage.Easy:
		case Constants.Webpage.Medium:
		case Constants.Webpage.Hard:
		case Constants.Webpage.Impossible: {
			difficultyWebpage(page);
			break;
		}
	}
};

export default pageLoad;
