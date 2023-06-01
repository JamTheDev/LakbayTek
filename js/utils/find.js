/**
 * 
 * @param {string} identifier 
 * @param {VoidFunction} callback 
 * @param {number} attempts 
 * @param {number} interval 
 * @returns Void
 * 
 * This function polls `identifier` (can either be a className or id) and checks for it's existence in the Document Object Model.
 */
export function pollSelectedQuery(identifier, callback, attempts = 3, interval = 500) {
    
    if (typeof(callback) !== "function") {
        return console.error("No callback function!");
    }

    const poll = setInterval(() => {
        const elToFind = document.querySelector(identifier);
        if (elToFind || attempts == 0) {
            if (attempts == 0) {
                clearInterval(poll);
                return console.error(`Maximum polling attempt of ${attempts} reached! Could not find element named "${identifier}"`);
            }

            callback();
            return clearInterval(poll);
        }

        attempts--;
    }, interval);
}