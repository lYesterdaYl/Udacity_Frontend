class Enemy{
    // Enemies our player must avoid
    constructor() {
        this.x = -100;
        this.y = Math.floor((Math.random() * 3) + 0) * 83 + 53;
        this.max_x = 505;

        this.speed = this.randomize_speed();

        // Variables applied to each of our instances go here,
        // we've provided one for you to get started

        // The image/sprite for our enemies, this uses
        // a helper we've provided to easily load images
        this.sprite = 'images/enemy-bug.png';
    }
    // Update the enemy's position, required method for game
// Parameter: dt, a time delta between ticks
    update(dt) {
        // You should multiply any movement by the dt parameter
        // which will ensure the game runs at the same speed for
        // all computers.
        // console.log(dt);
        this.movement();
    };

    //function to change the bug's x position with its speed.
    movement(){
        this.x += this.speed;
        if (this.x > this.max_x){
            this.x = -100;
            this.speed = this.randomize_speed();
            this.randomize_line();
        }
    }

    //gives the bug to appear in 1,2, or 3 line with a random generator.
    randomize_line(){
        this.y = Math.floor((Math.random() * 3) + 0) * 83 + 53;
    }

    //gives a random speed to the bug.
    randomize_speed(){
        return Math.floor((Math.random() * 3) + 1);
    }

    // Draw the enemy on the screen, required method for game
    render() {
        ctx.drawImage(Resources.get(this.sprite), this.x, this.y);
    };
}







// Now write your own player class
// This class requires an update(), render() and
// a handleInput() method.
class Player{
    constructor(){
        this.x = 202;
        this.y = 385;
        this.max_x = 505;
        this.max_y = 386;
        this.sprite = 'images/char-boy.png';
    }

    update(dt) {

        // You should multiply any movement by the dt parameter
        // which will ensure the game runs at the same speed for
        // all computers.

    };

    // Draw the enemy on the screen, required method for game
    render() {
        ctx.drawImage(Resources.get(this.sprite), this.x, this.y);
    };

    //check if the next position of the player is legal or not.
    check_next_position(action, position){
        if (action === "left"){
            return position[0] - 100 > 0;
        }
        else if (action === "right"){
            return position[0] + 101 < this.max_x;
        }
        else if (action === "up"){
            return position[1] - 82 > -30;
        }
        else if (action === "down") {
            return position[1] + 82 < this.max_y;
        }
    }

    //handle player's input
    handleInput(key){
        console.log(this.x, this.y);
        if (key === "left" && this.check_next_position(key, [this.x, this.y])) {
            this.x -= 101;
        }
        else if (key === "right" && this.check_next_position(key, [this.x, this.y])) {
            this.x += 101;
        }
        else if (key === "up" && this.check_next_position(key, [this.x, this.y])){
            this.y -= 83;
            if (this.y < 0){
                reset_game();

            }
        }
        else if (key === "down" && this.check_next_position(key, [this.x, this.y])) {
            this.y += 83;
        }
    }

    //reset the player to its original position.
    reset(){
        this.x = 202;
        this.y = 385;
    }
}

class Gem{
    constructor(){
        this.x = Math.floor((Math.random() * 5) + 0) * 101 + 25.25;
        this.y = Math.floor((Math.random() * 3) + 0) * 83 + 53 + 50;
        this.score = 0;
        this.sprite = this.generate_gem_skin();

    }

    //generate a random gem and gives certain score for collecting it.
    generate_gem_skin(){
        let num = Math.floor((Math.random() * 3) + 1);
        let path = "images/";
        if (num === 1){
            this.score = 100
            return path + "Gem-Blue.png";
        }
        else if (num === 2){
            this.score = 200;
            return path + "Gem-Green.png";
        }
        else{
            this.score = 300;
            return path + "Gem-Orange.png";
        }
    }

    //use to generate a new position for the collected gem.
    generate_new_position(){
        this.x = Math.floor((Math.random() * 5) + 0) * 101 + 25.25;
        this.y = Math.floor((Math.random() * 3) + 0) * 83 + 53 + 50;
    }

    //calculate the score, generate a new gem, and check if player wins.
    reward(){
        let score = document.querySelector('.score');
        total_score += this.score;
        score.textContent = total_score;

        this.generate_new_position();

        if (this.check_if_win()){
            this.update_win_stats();
            $("#modal").modal();
        }
    }

    //check if player wins the game after collected a gem.
    check_if_win(){
        if (total_score >= goal_score){
            return true;
        }
        else{
            return false;
        }
    }

    //update webpage's data based on player's performance.
    update_win_stats() {
        console.log(111);
        const win_score = document.querySelector('.win_score');
        win_score.textContent = total_score;

        const win_time = document.querySelector('.win_time');
        win_time.textContent = convert_second_to_time(time);

        const play_again_button = document.querySelector('.play_again_button');
        play_again_button.addEventListener('click', reset_game);
    }

    render() {
        ctx.drawImage(Resources.get(this.sprite), this.x, this.y, 50.5, 85.5);
    };
}



// Now instantiate your objects.
// Place all enemy objects in an array called allEnemies
// Place the player object in a variable called player
let allEnemies = [];
let player = new Player()
let allGems = [];

let timer_status = false; // true: timer starts false: timer stops
let time = 0; // number of seconds after the game starts

let total_score = 0;
let goal_score = 3000;

create_game();

// This listens for key presses and sends the keys to your
// Player.handleInput() method. You don't need to modify this.
document.addEventListener('keyup', function(e) {
    if (timer_status == false){
        window.$time = setInterval("update_time()", 1000);
        timer_status = true;
    }

    var allowedKeys = {
        37: 'left',
        38: 'up',
        39: 'right',
        40: 'down'
    };

    player.handleInput(allowedKeys[e.keyCode]);

});

//reset the game. Reset all the variable that the game needs.
function reset_game() {
    console.log(222);
    allEnemies = [];
    player = new Player()
    allGems = [];

    timer_status = false; // true: timer starts false: timer stops
    time = 0; // number of seconds after the game starts

    total_score = 0;
    goal_score = 3000;
    console.log(total_score);

    let timer = document.querySelector('.timer');
    timer.textContent = '00:00:00';

    const score = document.querySelector('.score');
    score.textContent = total_score;

    create_game();
}

//create game bug and gem array
function create_game() {
    for (let i = 0;i < 5;i++){
        let enemy = new Enemy();
        allEnemies.push(enemy);
    }

    for (let i = 0;i < 10;i++){
        let gem = new Gem();
        allGems.push(gem);
    }
}


//update the timer on the page
function update_time() {
    time++;
    let second = time;
    let text = convert_second_to_time(second)

    let timer = document.querySelector('.timer');
    timer.textContent = text;
}

//convert the number of seconds to better fotmated time
function convert_second_to_time(second) {
    var hours   = Math.floor(second / 3600);
    var minutes = Math.floor((second - (hours * 3600)) / 60);
    var seconds = second - (hours * 3600) - (minutes * 60);

    if (hours   < 10) {hours   = "0"+hours;}
    if (minutes < 10) {minutes = "0"+minutes;}
    if (seconds < 10) {seconds = "0"+seconds;}

    return hours+':'+minutes+':'+seconds;
}