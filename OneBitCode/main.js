const buttons = document.querySelectorAll(".button");
const display = document.getElementById("tela");
var b = true;

buttons.forEach((button) => {
  button.addEventListener("click", () => {
    if (b == true) {
      const buttonText = button.textContent;
      display.value += buttonText;
      display.scrollLeft = display.scrollWidth;
    }
  });
});

const clear = document.getElementById("clear");
clear.addEventListener("click", () => {
  display.value = "";
  b = true;
});

const equal = document.getElementById("equal");
equal.addEventListener("click", () => {
  if (b == true) {
    try {
      const result = evaluateExpression(display.value);
      display.value = result;
    } catch (error) {
      display.value = "ERROR";
      b = false;
    }
  }
});

function evaluateExpression(expression) {
  const sanitizedExpression = expression.replace(/[^\d+\-*/().]/g, "");
  return Function(`'use strict'; return (${sanitizedExpression})`)();
}
