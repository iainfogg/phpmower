todo

* Add a level of logic in the MowerController to start
the thing going, then respond to bumper hits with a 
turn for x degrees or seconds, then starting moving again.
* Need a way to have the current action in the MowerController
representing what the mower is trying to achieve from a 
user's perspective e.g. head forward until bump, head
home to charge, turn before heading off again. This needs,
in some scenarios, to be timer based, but those timer based
actions must be abortable if something else happens
e.g. it gets tipped over.
