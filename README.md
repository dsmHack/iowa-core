# Iowa C.O.R.E.
2020 DSM Hack repo for Iowa C.O.R.E.
[Rethink Iowa Website](https://impact.rethinkiowa.org/)
## Build Status
[![Build Status](https://travis-ci.org/dsmHack/iowa-core.svg?branch=master)](https://travis-ci.org/dsmHack/iowa-core)

## Tech Stack

WordPress website using PHP and JavaScript

## Hackathon Team
* [Tony Brobston](https://github.com/TonyBrobston)
* [Mike Kang](https://github.com/mikekang-wk)
* [Paul Kang](https://github.com/paulkangdev)
* [Edwin O. Martinez](https://github.com/Guarionex)
* [Leah Haugh](https://github.com/leahhaugh)
* Josh Angolano
* [Val Yeltman](https://github.com/valyeltman-wk)
* [Gopo Iyer](https://github.com/geiyer)
* [Wesley Ng](https://github.com/WesleyNgWeLi)
* Peter Chodakowski
* [Jordan Van Kampen](https://github.com/jvankampen)

## Future Heatmaps
Ideally we would refactor what we currently have and build some sort of contract or interface, like a function that takes in an api endpoint, the json path to the field we want to use for the heatmap weighting, etc. and return that heatmap weighting value, zip code, and county. If we coded a solution that expects this contract we could create a form to input these values and store them in wordpress, then pull that value in `map.php` and interate over these form entries to build heatmaps. However this is quite a bit of work and at the hackathon we didn't have time to prove this concept.

For a future developer, to add another heat map you will do something similar to the following. I apologize that this guide will not be complete, so please follow loosly.
1. Assuming you can use docker run `docker-compose.yaml`
2. Navigate to http://localhost:8080
3. Create a new site (copy the password)
4. Login as admin and navigate to Appearance > Themes and enabled "Iowa Core"
5. Navgiate back to http://localhost:8080 to see the theme
6. At this point you now have a non-production environment to play around (no you won't have data unfortunately).
7. Next we'll make some code changes
8. Make another option here: https://github.com/dsmHack/iowa-core/blob/ce092ea1cbd056238342e98010c1ccade13c289c/map.php#L29
9. Use the value from the last step and create another `else if` here: https://github.com/dsmHack/iowa-core/blob/ce092ea1cbd056238342e98010c1ccade13c289c/map.php#L287
10. Make another function call here: https://github.com/dsmHack/iowa-core/blob/ce092ea1cbd056238342e98010c1ccade13c289c/map.php#L286
11. Create the function it will call like this one: https://github.com/dsmHack/iowa-core/blob/ce092ea1cbd056238342e98010c1ccade13c289c/map.php#L127
12. In the function from the last step, you'll need to find another GET Rest endpoint. When calling this endpoint the response data will be in `xhr.responseText`. You'll need to pull the heatmap weighting value from this data and pass it to the `census_variable` like this: https://github.com/dsmHack/iowa-core/blob/ce092ea1cbd056238342e98010c1ccade13c289c/map.php#L150
13. Assuming you copied another function, you should be able to navigate to http://localhost:8080 and choose your new heatmap from the dropdown in the top left corner of the map.
14. If I had to guess the most challenging part will be returning the correct data through a GET Rest endpoint and then pulling the heatmap weighting value from that data. This requires knowledge in rest endpoints, specifically how to call them and return different data, I can't explain this in 10 words or less :shrug:, and JSON (JavaScript Object Notation). The best advice that I can give is reading up on these previously mentioned things and look at the other examples in this repo. 

#### UnemploymentBenefitDollarsPerCounty:

https://github.com/dsmHack/iowa-core/blob/ce092ea1cbd056238342e98010c1ccade13c289c/map.php#L130
https://github.com/dsmHack/iowa-core/blob/ce092ea1cbd056238342e98010c1ccade13c289c/map.php#L137

#### UnemploymentStatisticData:

https://github.com/dsmHack/iowa-core/blob/ce092ea1cbd056238342e98010c1ccade13c289c/map.php#L187
https://github.com/dsmHack/iowa-core/blob/ce092ea1cbd056238342e98010c1ccade13c289c/map.php#L193

15. Once this is working you'll need to FTP these changes to the Wordpress server. At one point I had some CI/CD (continuous integration/continuous deployment) setup which you can find a code sample here: https://github.com/dsmHack/iowa-core/blob/762045f50832290cb8ace716a5f1863d068c5dba/.scripts/deploy.sh The travis-ci likely does not have the correct ftp values set, so those would need updated if we went this route. Using something like Filezilla will work in the short term.
16. Ideally we would refactor to change the code to make it easier to understand and more concise, there is definitely a lot of duplicate code that is unnecessary. Refactoring this is not a requirement.
