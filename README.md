# HackTrinity18
All things needed to run the HackTrinity18 Capture The Flag

## About
HackTrinity '18 was an online Capture The Flag competition run from 29th January - 2nd February 2018 run by students in Trinity College Dublin.

- 163 contestants took part

- 107 were TCD students, 47 of whom were in their 1st year of college

- 56 were from DCU, ITB, LYIT or people working in industry, who took part simultaneously

- 19 challenges were released, 4 people solved all of the challenges, 136 people solved at least one challenge.

- We handled over 12 million HTTP requests to the challenge server during the week (which created nginx logs so large it nearly filled one of the partitions on the server. Oopsie.)

## Writeup (Challenge solutions)
Noah Ó Donnaile has kindly written up his solutions to all of the challenges from the competition here: http://mycode.doesnot.run/2018/02/03/hacktrinity/ . However there are two additional challenges in this repo which we had to pull from the competition as they gobbled RAM or allowed inter-competitor interference :)

## Running challenges
Most challenges can be run by cd-ing into the challenge directory and running `docker-compose up`. Others have static challenge files associated with them or rather custom build scripts. Unfortunately we put this competition together in a huge rush (can you tell? :D) so there are some edge cases where challenge descriptions are incorrect etc. so apologies for that.
