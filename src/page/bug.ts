import { checkBoxLabels, insertHTMLById, returnCheckedLabels } from "../utils";

const bugWebpage = () => {
	const emailId = "email";
	const descriptionId = "description";
	const osId = "os";
	const browserId = "browser";
	const severityId = "severity";
	const dateId = "date";
	const labelId = "label";
	const fieldsetId = "labels";

	const submitButtonTag = "input[type=submit]";
	const resetButtonTag = "input[type=reset]";
	const emailTag = `#${emailId}`;
	const descriptionTag = `#${descriptionId}`;
	const osTag = `#${osId}`;
	const browserTag = `#${browserId}`;
	const severityTag = `#${severityId}`;
	const dateTag = `#${dateId}`;
	const labelTag = "input[type=checkbox]";
	const previewTag = "#preview";

	$(resetButtonTag).button();
	$(osTag).selectmenu();
	$(browserTag).selectmenu();
	$(submitButtonTag).button();
	$(severityTag)
		.spinner({
			min: 1,
			max: 10,
		})
		.val(1);
	$(dateTag)
		.datepicker({
			yearRange: "2000:2030",
			dateFormat: "dd/mm/yy",
		})
		.datepicker("setDate", new Date());
	
	checkBoxLabels(fieldsetId);
	// @ts-ignore
	$(labelTag).checkboxradio();

	$(previewTag).hide();
	$(submitButtonTag).on("click", (event: JQuery.ClickEvent) => {
		event.preventDefault();

		const email = <string>$(emailTag).val();
		const description = <string>$(descriptionTag).val();
		const os = $(osTag).find(":selected").text();
		const browser = $(browserTag).find(":selected").text();
		const severity = $(severityTag).spinner("value").toString();
		const date = <string>$(dateTag).val();
		const labels = "[]";

		insertHTMLById(`${emailId}_text`, email);
		insertHTMLById(`${descriptionId}_text`, description);
		insertHTMLById(`${osId}_text`, os);
		insertHTMLById(`${browserId}_text`, browser);
		insertHTMLById(`${severityId}_text`, severity);
		insertHTMLById(`${dateId}_text`, date);
		insertHTMLById(`${labelId}_text`, returnCheckedLabels());

		$(previewTag).show();
	});
};

export default bugWebpage;
