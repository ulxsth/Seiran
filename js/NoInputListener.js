const LIMIT = 3000;

let timeoutId;
function resetTimer() {
  if (timeoutId) {
    clearTimeout(timeoutId);
  }
  timeoutId = setTimeout(function () {
    // TODO: save book
    console.log("book saved.");
  }, LIMIT);
}
