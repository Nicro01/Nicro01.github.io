const buttons = document.querySelectorAll(".button");
const display = document.getElementById("tela");
const keys1 = document.querySelector(".teclas");
const keys2 = document.querySelector(".teclas-2");
let resultado = false;
let valorAtual = "";

let b = true;

buttons.forEach((button) => {
  button.addEventListener("click", () => {
    if (b == true) {
      const buttonText = button.textContent;

      if (
        resultado &&
        buttonText !== "+" &&
        buttonText !== "-" &&
        buttonText !== "*" &&
        buttonText !== "/" &&
        buttonText !== "." &&
        buttonText !== "%" &&
        buttonText !== "x\u00B2"
      ) {
        valorAtual = buttonText;
      } else {
        if (buttonText === "x\u00B2") {
          valorAtual += "\u00B2";
        } else {
          valorAtual += buttonText;
        }
      }

      display.value = valorAtual;
      resultado = false;

      display.scrollLeft = display.scrollWidth;
    }
  });
});

const clear = document.getElementById("clear");
const clear_2 = document.getElementById("clear-2");
clear.addEventListener("click", () => {
  display.value = "";
  valorAtual = "";
  b = true;
});
clear_2.addEventListener("click", () => {
  display.value = "";
  valorAtual = "";
  b = true;
});

const equal = document.getElementById("equal");
const equal_2 = document.getElementById("equal-2");

equal_2.addEventListener("click", () => {
  if (b == true) {
    try {
      const result = evaluateExpression(display.value);
      display.value = result;
      valorAtual = result;
      resultado = true;
    } catch (error) {
      display.value = "ERROR";
      valorAtual = "";
      b = false;
    }
  }
});

equal.addEventListener("click", () => {
  if (b == true) {
    try {
      const result = evaluateExpression(display.value);
      display.value = result;
      valorAtual = result;
      resultado = true;
    } catch (error) {
      display.value = "ERROR";
      valorAtual = "";
      b = false;
    }
  }
});

const quadrado = document.getElementById("quadrado");
quadrado.addEventListener("click", () => {
  if (b == true) {
    handleQuadradoClick();
    resultado = true;
  }
});

function evaluateExpression(expression) {
  const sanitizedExpression = expression.replace(/[^\d+\-*/().%]/g, "");
  return Function(`'use strict'; return (${sanitizedExpression})`)();
}

function handleQuadradoClick() {
  if (b == true) {
    const value = display.value;
    const squaredValue = evaluateExpression(`(${value}) * (${value})`);
    display.value = squaredValue;
    valorAtual = squaredValue;
  }
}

function changeKeys() {
  if (keys1.style.display === "none") {
    keys1.style.display = "grid";
    keys2.style.display = "none";
  } else {
    keys1.style.display = "none";
    keys2.style.display = "grid";
  }
}
