<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />	
<title>404 Page Not Found</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="author" content="BuilderEngine">
<style type="text/css">

.not-found-page {
  height: 100%;
  background: #3A4F68;
  background: -moz-radial-gradient(center, ellipse cover, #4d6077 0%, #3a4f68 100%);
  background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #4d6077), color-stop(100%, #3a4f68));
  background: -webkit-radial-gradient(center, ellipse cover, #4d6077 0%, #3a4f68 100%);
  background: -o-radial-gradient(center, ellipse cover, #4d6077 0%, #3a4f68 100%);
  background: -ms-radial-gradient(center, ellipse cover, #4d6077 0%, #3a4f68 100%);
  background: radial-gradient(ellipse at center, #4d6077 0%, #3a4f68 100%);
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr = '#4D6077', endColorstr = '#3A4F68', GradientType = 1); }

#not-found {
  overflow: hidden; }
  #not-found .info {
    text-align: center;
    padding-top: 100px; }
    #not-found .info h1 {
      color: #fff;
      font-size: 13em;
      margin-bottom: 20px;
      font-weight: 200;
      letter-spacing: -3px;
      text-shadow: 1px 1px rgba(0, 0, 0, 0.35); }
    #not-found .info p {
      font-size: 31px;
      font-weight: 100;
      color: #FFF;
      text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.35);
      letter-spacing: 2px;
      margin-bottom: 0; }
    #not-found .info .go-back {
      font-size: 17px;
      text-shadow: none;
      letter-spacing: 0px;
      font-weight: 200;
      color: #9BB2CE;
      z-index: 999;
      position: absolute;
      left: 0;
      right: 0;
      padding: 25px 0;
      max-width: 400px;
      margin: auto;
      margin-top: -15px; }
      #not-found .info .go-back a {
        color: #fff; }
  #not-found #container canvas {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0; }

#not-found-alt {
  overflow: hidden; }
  #not-found-alt .info {
    text-align: center;
    margin-top: 30px;
    position: absolute;
    width: 100%; }
    #not-found-alt .info h1 {
      color: #fff;
      font-size: 11em;
      margin-bottom: 20px;
      font-weight: 200;
      letter-spacing: -3px;
      text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.15); }
    #not-found-alt .info p {
      font-size: 28px;
      font-weight: 200;
      color: #4D728A;
      /*text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.75);*/
      margin-bottom: 0; }
    #not-found-alt .info .go-back {
      font-size: 17px;
      text-shadow: none;
      letter-spacing: 0px;
      font-weight: 200;
      color: #506379;
      z-index: 999;
      position: absolute;
      left: 0;
      right: 0;
      padding: 25px 0;
      max-width: 400px;
      margin: auto;
      margin-top: -15px; }
      #not-found-alt .info .go-back a {
        color: #429AD5;
        text-shadow: 1px 1px 1px rgba(255, 255, 255, 0.4);
        font-size: 18px; }
  #not-found-alt canvas {
    background: linear-gradient(#b3d4e6 0%, #eef4f6 75%);
    display: block; }
  #not-found-alt #container {
    height: 100%;
    left: 0;
    position: fixed;
    top: 0;
    width: 100%;
    /*background: url(http://jackrugile.com/images/misc/skyline-texture.png);*/ }
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="themes/pro/js/bootstrap.js"></script>
<script src="themes/pro/js/sketch.min.js"></script>

</head>
<body id="not-found-alt">
  <div class="info">
    <h1>404</h1>
    <p>Oops, the page you're looking for doesn't exist.</p>

    <p class="go-back">
      Please return to our <a href="/index.php">Home page</a>.
    </p>
  </div>
	<div id="container"></div>

	<script type="text/javascript">
		var Building, Skyline, dt, sketch, skylines;

        sketch = Sketch.create();

        sketch.mouse.x = sketch.width / 10;

        sketch.mouse.y = sketch.height;

        skylines = [];

        dt = 1;

        Building = function(config) {
          return this.reset(config);
        };

        Building.prototype.reset = function(config) {
          this.layer = config.layer;
          this.x = config.x;
          this.y = config.y;
          this.width = config.width;
          this.height = config.height;
          this.color = config.color;
          this.slantedTop = floor(random(0, 10)) === 0;
          this.slantedTopHeight = this.width / random(2, 4);
          this.slantedTopDirection = round(random(0, 1)) === 0;
          this.spireTop = floor(random(0, 15)) === 0;
          this.spireTopWidth = random(this.width * .01, this.width * .07);
          this.spireTopHeight = random(10, 20);
          this.antennaTop = !this.spireTop && floor(random(0, 10)) === 0;
          this.antennaTopWidth = this.layer / 2;
          return this.antennaTopHeight = random(5, 20);
        };

        Building.prototype.render = function() {
          sketch.fillStyle = sketch.strokeStyle = this.color;
          sketch.lineWidth = 2;
          sketch.beginPath();
          sketch.rect(this.x, this.y, this.width, this.height);
          sketch.fill();
          sketch.stroke();
          if (this.slantedTop) {
            sketch.beginPath();
            sketch.moveTo(this.x, this.y);
            sketch.lineTo(this.x + this.width, this.y);
            if (this.slantedTopDirection) {
              sketch.lineTo(this.x + this.width, this.y - this.slantedTopHeight);
            } else {
              sketch.lineTo(this.x, this.y - this.slantedTopHeight);
            }
            sketch.closePath();
            sketch.fill();
            sketch.stroke();
          }
          if (this.spireTop) {
            sketch.beginPath();
            sketch.moveTo(this.x + (this.width / 2), this.y - this.spireTopHeight);
            sketch.lineTo(this.x + (this.width / 2) + this.spireTopWidth, this.y);
            sketch.lineTo(this.x + (this.width / 2) - this.spireTopWidth, this.y);
            sketch.closePath();
            sketch.fill();
            sketch.stroke();
          }
          if (this.antennaTop) {
            sketch.beginPath();
            sketch.moveTo(this.x + (this.width / 2), this.y - this.antennaTopHeight);
            sketch.lineTo(this.x + (this.width / 2), this.y);
            sketch.lineWidth = this.antennaTopWidth;
            return sketch.stroke();
          }
        };

        Skyline = function(config) {
          this.x = 0;
          this.buildings = [];
          this.layer = config.layer;
          this.width = {
            min: config.width.min,
            max: config.width.max
          };
          this.height = {
            min: config.height.min,
            max: config.height.max
          };
          this.speed = config.speed;
          this.color = config.color;
          this.populate();
          return this;
        };

        Skyline.prototype.populate = function() {
          var newHeight, newWidth, totalWidth, _results;
          totalWidth = 0;
          _results = [];
          while (totalWidth <= sketch.width + (this.width.max * 2)) {
            newWidth = round(random(this.width.min, this.width.max));
            newHeight = round(random(this.height.min, this.height.max));
            this.buildings.push(new Building({
              layer: this.layer,
              x: this.buildings.length === 0 ? 0 : this.buildings[this.buildings.length - 1].x + this.buildings[this.buildings.length - 1].width,
              y: sketch.height - newHeight,
              width: newWidth,
              height: newHeight,
              color: this.color
            }));
            _results.push(totalWidth += newWidth);
          }
          return _results;
        };

        Skyline.prototype.update = function() {
          var firstBuilding, lastBuilding, newHeight, newWidth;
          this.x -= (sketch.mouse.x * this.speed) * dt;
          firstBuilding = this.buildings[0];
          if (firstBuilding.width + firstBuilding.x + this.x < 0) {
            newWidth = round(random(this.width.min, this.width.max));
            newHeight = round(random(this.height.min, this.height.max));
            lastBuilding = this.buildings[this.buildings.length - 1];
            firstBuilding.reset({
              layer: this.layer,
              x: lastBuilding.x + lastBuilding.width,
              y: sketch.height - newHeight,
              width: newWidth,
              height: newHeight,
              color: this.color
            });
            return this.buildings.push(this.buildings.shift());
          }
        };

        Skyline.prototype.render = function() {
          var i;
          i = this.buildings.length;
          sketch.save();
          sketch.translate(this.x, (sketch.height - sketch.mouse.y) / 20 * this.layer);
          while (i--) {
            this.buildings[i].render(i);
          }
          return sketch.restore();
        };

        sketch.setup = function() {
          var i, _results;
          i = 5;
          _results = [];
          while (i--) {
            _results.push(skylines.push(new Skyline({
              layer: i + 1,
              width: {
                min: (i + 1) * 30,
                max: (i + 1) * 40
              },
              height: {
                min: 150 - (i * 35),
                max: 300 - (i * 35)
              },
              speed: (i + 1) * .003,
              color: 'hsl( 200, ' + (((i + 1) * 1) + 10) + '%, ' + (75 - (i * 13)) + '% )'
            })));
          }
          return _results;
        };

        sketch.clear = function() {
          return sketch.clearRect(0, 0, sketch.width, sketch.height);
        };

        sketch.update = function() {
          var i, _results;
          dt = sketch.dt < .1 ? .1 : sketch.dt / 16;
          dt = dt > 5 ? 5 : dt;
          i = skylines.length;
          _results = [];
          while (i--) {
            _results.push(skylines[i].update(i));
          }
          return _results;
        };

        sketch.draw = function() {
          var i, _results;
          i = skylines.length;
          _results = [];
          while (i--) {
            _results.push(skylines[i].render(i));
          }
          return _results;
        };

        $(window).on('mousemove', function(e) {
          // sketch.mouse.x = e.pageX;
          return sketch.mouse.y = e.pageY;
        });
	</script>
</body>
</html>