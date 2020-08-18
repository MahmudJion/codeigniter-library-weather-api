# Weather_api
Getting current weather based on geo location using ip address

### Using CodeIgniter Libraries
All of the available libraries are located in your system/libraries/ directory. In most cases, to use one of these classes involves initializing it within a controller using the following initialization method:

```sh
$this->load->library('class_name');
```

Where ‘class_name’ is the name of the class you want to invoke. For example, to load the Form Validation Library you would do this:

```sh
$this->load->library('form_validation');
```

Once initialized you can use it as indicated in the user guide page corresponding to that class.

Additionally, multiple libraries can be loaded at the same time by passing an array of libraries to the load method.

Example:

```sh
$this->load->library(array('email', 'table'));
```
