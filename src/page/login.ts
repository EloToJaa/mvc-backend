import Constants from "../constants";
import { redirect } from "../utils";
import { checkCredentials, generateCredentials } from "../credentials";

const changePasswordVisibility = (
	checkboxTag: string,
	passwordTextbox: HTMLInputElement
) => {
	const checked = $(checkboxTag).is(":checked");
	if (checked) {
		passwordTextbox.type = Constants.TextboxType.Text;
	} else {
		passwordTextbox.type = Constants.TextboxType.Password;
	}
};

const loginWebpage = () => {
	const difficulty = localStorage.getItem(Constants.Key.Difficulty);
	if (!difficulty) {
		redirect(Constants.Webpage.Start);
		return;
	}
	const checkboxTag = "#checkbox1";
	const submitButtonTag = "#submitBtn";
	const helpButtonTag = "#helpBtn";
	const helpDialogTag = "#help_dialog";
	const successDialogTag = "#success_dialog";
	const loginId = "login";
	const passwordId = "password";
	const loginTag = `#${loginId}`;
	const passwordTag = `#${passwordId}`;
	const loginTextbox = <HTMLInputElement>document.getElementById(loginId);
	const passwordTextbox = <HTMLInputElement>(
		document.getElementById(passwordId)
	);
	sessionStorage.setItem(Constants.Key.Failures, "0");
	changePasswordVisibility(checkboxTag, passwordTextbox);
	$(checkboxTag).on("change", () => {
		changePasswordVisibility(checkboxTag, passwordTextbox);
	});
	generateCredentials();
	$(submitButtonTag).button();
	$(submitButtonTag).on("click", (event: JQuery.ClickEvent) => {
		event.preventDefault();
		checkCredentials(
			difficulty,
			loginTag,
			passwordTag,
			successDialogTag,
			loginTextbox,
			passwordTextbox
		);
	});
	$(helpButtonTag).button();
	$(helpDialogTag).dialog();
	$(helpDialogTag).dialog("close");
	$(successDialogTag).dialog();
	$(successDialogTag).dialog("close");
	$(helpButtonTag).on("click", (event: JQuery.ClickEvent) => {
		event.preventDefault();
		$(helpDialogTag).dialog("open");
	});
};

export default loginWebpage;
