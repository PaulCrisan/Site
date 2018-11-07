<div class="mvc-description">
  <p>This web site was created with an MVC structure build from scratch and without using any template engines or other libraries. Source code can be found here.
One of the challenges that someone encounters when working with a Php MVC architecture is the cumbersome amount of files and folders needed which can create a lot of confusion.  Working with an already tested professional framework, like Laravel, will take care of that but an important step in understanding MVC is creating one from scratch.
In an extremely simplified explanation, the whole line of actions can be described like this:
</p>
<p>HTTP request(URL)
>> web entry point(index page)
>> router or dispacher(braking down URL address and assigning a controller)
>> controller(assigning a view or retrieving data from the Model if needed before passing it to the view)
>> view(rendering the HTML on the web page)

Each web page will therefore have it’s own Model, View and Controller.
Starting from this simplified form in mind, we can build a more robust structure using all the tools provided by Php.</p>
<p>The web entry point(index page) will use an autoloader to import all the classes needed at real time and
   instantiate the Router class which will decide where the URL request will be directed.</p>
  <div class="gist">
    <script src="https://gist.github.com/PaulCrisan/c15e03afa53f4b42649ed944d8effc62.js"></script>
  </div>
<p>In Router class, to brake down the URL we could use explode() function but a more elegant and effective solution, used by many frameworks, is Regex (regular expressions).
Regex is very powerful in finding patterns to match.
The Router class will also assign the controller required after braking down the URL</p>
<div class="gist">
  <script src="https://gist.github.com/PaulCrisan/ec643a9eb608b9dbaff310f64e84724b.js"></script>
</div>
<p>Controller class could be either an abstract class that can be extended to avoid creating it for every page or not. The class will assign a view
  according to the parameter received from URL. It will also   request data from the Model.</p>
<div class="gist">
  <script src="https://gist.github.com/PaulCrisan/cfbfadd89809cae4afa17f0bcecaa985.js"></script>
</div>
<p>The view class will render the HTML</p>
<div class="gist">
  <script src="https://gist.github.com/PaulCrisan/3589e24ded902597fa09de95aa615ef4.js"></script>
</div>
</div>
