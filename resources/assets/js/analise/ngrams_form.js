window.changeStats = function (nGramSize) {
    let ngrams = {};
    var target = document.getElementById("stats");

    ngrams[2] = [
        {text: "True Mutual Information", value: "tmi"},
        {text: "Pointwise Mutual Information", value: "pmi"},
        {text: "Dice", value: "dice"},
        {text: "Log-Likelihood", value: "ll"},
        {text: "Chi-Square Test", value: "x2"},
        {text: "Left-Fisher Test of Associativity", value: "leftFisher"},
        {text: "Right-Fisher Test of Associativity", value: "rightFisher"},
        {text: "T-Score", value: "pmi"},
        {text: "Phi Coefficient", value: "phi"},
        {text: "Odds Ratio", value: "odds"},
    ];

    ngrams[3] = [
        {text: "True Mutual Information", value: "tmi"},
        {text: "Log-Likelihood", value: "ll"}
    ];

    clearOptions(target, true);

    if (typeof ngrams[nGramSize] != "undefined") {
        ngrams[nGramSize].forEach(createOption.bind(null, target));
    }
}

window.showUpload = function(select) {
    let stopList = select.value;
    toggle = (stopList == 'default') ? 'none' : 'flex';
    toggleElm(document.getElementById("upload_div"), toggle);
}

//initial
document.addEventListener("DOMContentLoaded",function(){
    changeStats(document.getElementById("nGramSize").value);
    showUpload(document.getElementById("stopList"));
});
