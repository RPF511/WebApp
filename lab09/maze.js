/* CSE3026 : Web Application Development
 * Lab 09 - Maze
 */

var loser = null;  // whether the user has hit a wall

window.onload = function() {
    $("start").observe("click", startClick);
};

// called when mouse enters the walls; 
// signals the end of the game with a loss
function overBoundary(event) {
    var wall = $$(".boundary");
    for (var i = 0; i < wall.length; i++) {
        wall[i].addClassName("youlose");
        wall[i].stopObserving("mouseover");
    }
    $("end").stopObserving("mouseover");
    $("maze").stopObserving("mouseleave");
    //alert("You lose! :(");
    $("status").innerHTML = "You lose! :(";
}

// called when mouse is clicked on Start div;
// sets the maze back to its initial playable state
function startClick() {
    var wall = $$(".boundary");
    //console.log(wall);
    for (var i = 0; i < wall.length; i++) {
        wall[i].removeClassName("youlose");
        wall[i].observe("mouseover", overBoundary);
    }
    $("status").innerHTML = "move your cursor to the end!";
    $("maze").observe("mouseleave", overBody);
    $("end").observe("mouseover", overEnd);
}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
    var wall = $$(".boundary");
    for (var i = 0; i < wall.length; i++) {
        wall[i].stopObserving("mouseover");
    }
    $("status").innerHTML = "You win! :)";
    $("maze").stopObserving("mouseleave");
    $("end").stopObserving("mouseover");
}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {
    overBoundary();
}
