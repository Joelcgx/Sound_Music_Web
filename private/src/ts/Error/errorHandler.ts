import { ShowUI } from "./UI.js";

$(() => {
  ErrorLogin();
});

function ErrorLogin() {
  if (window.location.search.includes("?error=")) {
    ShowUI(window.location.search.split("?error=")[1]);
  }
}
