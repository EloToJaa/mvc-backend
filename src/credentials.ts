import { hashPassword, rotEncrypt } from "./password";
import Constants from "./constants";
import {
	createLoginResultElement,
	getRandomNumber,
	insertHTMLById,
	removeElementsByClassName,
} from "./utils";
import Types from "./types";

let generatedLogin: Types.Credentials = null;
let generatedPassword: Types.Credentials = null;

const compareCredentials = (
	loginTextbox: HTMLInputElement,
	passwordTextbox: HTMLInputElement
): boolean => {
	return (
		loginTextbox.value == generatedLogin &&
		passwordTextbox.value == generatedPassword
	);
};

const encrypt = (text: string) => {
	const difficultyLevel = localStorage.getItem(Constants.Key.Difficulty);
	if (
		difficultyLevel == Constants.DifficultyLevel.Easy ||
		difficultyLevel == Constants.DifficultyLevel.Medium
	) {
		return rotEncrypt(text);
	} else {
		return hashPassword(text);
	}
};

export const generateCredentials = () => {
	$.get(
		// "https://raw.githubusercontent.com/DavidWittman/wpxmlrpcbrute/master/wordlists/1000-most-common-passwords.txt",
		"https://raw.githubusercontent.com/danielmiessler/SecLists/master/Passwords/Common-Credentials/10-million-password-list-top-1000.txt",
		(data, status) => {
			if (status === "success") {
				const passwords: string[] = data.split(/\r?\n/);
				const login =
					passwords[getRandomNumber(0, passwords.length - 1)];
				const password =
					passwords[getRandomNumber(0, passwords.length - 1)];
				generatedLogin = login;
				generatedPassword = password;
				sessionStorage.setItem(
					Constants.Key.Credentials,
					JSON.stringify({
						login: encrypt(login),
						password: encrypt(password),
					})
				);
				console.log(`Login: ${login}, Password: ${password}`);
			} else {
				console.log("Could not get passwords file");
			}
		}
	);
};

export const checkCredentials = (
	difficulty: string,
	loginTag: string,
	passwordTag: string,
	successDialogTag: string,
	loginTextbox: HTMLInputElement,
	passwordTextbox: HTMLInputElement
) => {
	const validCredentials = compareCredentials(loginTextbox, passwordTextbox);
	const failuresId = "failures";
	removeElementsByClassName("successful-login");
	removeElementsByClassName("wrong-login");
	if (validCredentials) {
		$(loginTag).removeClass("wrong");
		$(passwordTag).removeClass("wrong");
		const numberOfFailures = parseInt(
			sessionStorage.getItem(Constants.Key.Failures)
		);
		const successMessage = `Zalogowano po <b>${
			numberOfFailures + 1
		} próbach</b>`;
		createLoginResultElement("success", `Gratulacje! ${successMessage}`);
		insertHTMLById(
			successDialogTag.replace("#", ""),
			`<p>${successMessage}</p>`
		);
		$(successDialogTag).dialog("open");
		sessionStorage.setItem(Constants.Key.Failures, "0");
		insertHTMLById(failuresId, "0");
	} else {
		const numberOfFailures =
			parseInt(sessionStorage.getItem(Constants.Key.Failures)) + 1;
		sessionStorage.setItem(
			Constants.Key.Failures,
			numberOfFailures.toString()
		);
		insertHTMLById(failuresId, numberOfFailures.toString());
		if (
			difficulty == Constants.DifficultyLevel.Easy ||
			difficulty == Constants.DifficultyLevel.Hard
		) {
			if (
				loginTextbox.value != generatedLogin &&
				passwordTextbox.value != generatedPassword
			) {
				createLoginResultElement(
					"failure",
					"Niepoprawny login i hasło"
				);
				$(loginTag).addClass("wrong");
				$(passwordTag).addClass("wrong");
			} else if (loginTextbox.value != generatedLogin) {
				createLoginResultElement("failure", "Niepoprawny login");
				$(loginTag).addClass("wrong");
				$(passwordTag).removeClass("wrong");
			} else {
				createLoginResultElement("failure", "Niepoprawne hasło");
				$(loginTag).removeClass("wrong");
				$(passwordTag).addClass("wrong");
			}
		} else {
			createLoginResultElement("failure", "Niepoprawne dane logowania");
			$(loginTag).addClass("wrong");
			$(passwordTag).addClass("wrong");
		}
	}
};
