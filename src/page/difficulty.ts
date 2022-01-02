import { redirect } from "../utils";
import Constants from "../constants";
import Types from "../types";

const difficultyWebpage = (difficulty: Types.Difficulty) => {
	localStorage.setItem(Constants.Key.Difficulty, difficulty);
	redirect(`../../../${Constants.Webpage.Login}`);
};

export default difficultyWebpage;
