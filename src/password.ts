import { getRandomNumber } from "./utils";

export const hashPassword = (password: string) => {
	const P = 127,
		M = 1000000007;
	let hash = 0,
		pow = 1;
	for (let i = 0; i < password.length; i++) {
		hash = (hash + pow * password.charCodeAt(i)) % M;
		pow = (pow * P) % M;
	}
	return hash;
};

export const rotEncrypt = (password: string) => {
	const chars = "azAZ09",
		key = getRandomNumber(1, 25),
		alphabetLength = 26,
		numbersLength = 10;
	let answer = "";
	for (let i = 0; i < password.length; i++) {
		let code: number;
		if (
			password.charCodeAt(i) >= chars.charCodeAt(0) &&
			password.charCodeAt(i) <= chars.charCodeAt(1)
		) {
			code = password.charCodeAt(i) + key;
			if (code > chars.charCodeAt(1)) {
				code -= alphabetLength;
			}
		} else if (
			password.charCodeAt(i) >= chars.charCodeAt(2) &&
			password.charCodeAt(i) <= chars.charCodeAt(3)
		) {
			code = password.charCodeAt(i) + key;
			if (code > chars.charCodeAt(3)) {
				code -= alphabetLength;
			}
		} else if (
			password.charCodeAt(i) >= chars.charCodeAt(4) &&
			password.charCodeAt(i) <= chars.charCodeAt(5)
		) {
			code = password.charCodeAt(i) + (key % (numbersLength - 1)) + 1;
			if (code > chars.charCodeAt(5)) {
				code -= numbersLength;
			}
		} else {
			code = password.charCodeAt(i);
		}
		answer += String.fromCharCode(code);
	}
	return answer;
};
