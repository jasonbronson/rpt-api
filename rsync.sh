#!/bin/bash
rsync -av --rsh='ssh -p 47654' * root@melnew:/web/api.rockypointtravel.com/
