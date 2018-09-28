class Enemy{
    // Enemies our player must avoid
    constructor() {
        this.x = -100;
        this.y = Math.floor((Math.random() * 3) + 0) * 83 + 53;
        this.max_x = 505;

        this.speed = this.randomize_speed();
        // this.y = 2 * 65;

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

    movement(){
        this.x += this.speed;
        if (this.x > this.max_x){
            this.x = -100;
            this.speed = this.randomize_speed();
        }
    }

    randomize_speed(){
        return Math.floor((Math.random() * 10) + 1);
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

    handleInput(key){
        if (key === "left" && this.check_next_position(key, [this.x, this.y])) {
            this.x -= 101;
        }
        else if (key === "right" && this.check_next_position(key, [this.x, this.y])) {
            this.x += 101;
        }
        else if (key === "up" && this.check_next_position(key, [this.x, this.y])){
            this.y -= 83;
            if (this.y < 0){
                this.reset();
            }
        }
        else if (key === "down" && this.check_next_position(key, [this.x, this.y])) {
            this.y += 83;
        }
    }

    reset(){
        this.x = 202;
        this.y = 385;
    }
}

class Gem{
    constructor(){
        this.x = Math.floor((Math.random() * 6) + 0) * 101;
        this.y = Math.floor((Math.random() * 3) + 0) * 83 + 53;
        
        this.sprite = 'images/enemy-bug.png';

    }
}



// Now instantiate your objects.
// Place all enemy objects in an array called allEnemies
// Place the player object in a variable called player

let allEnemies = [];
let player = new Player()

for (let i = 0;i < 10;i++){
    let enemy = new Enemy();
    allEnemies.push(enemy);
}
console.log(allEnemies);

// This listens for key presses and sends the keys to your
// Player.handleInput() method. You don't need to modify this.
document.addEventListener('keyup', function(e) {
    var allowedKeys = {
        37: 'left',
        38: 'up',
        39: 'right',
        40: 'down'
    };

    player.handleInput(allowedKeys[e.keyCode]);

});
