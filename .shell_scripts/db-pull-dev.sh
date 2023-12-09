# save pwd
PWD=$(pwd)

# get google drive download link for most recent database backup from dev site, save output as variable 
LINK=$(terminus backup:get wcu-wp.live --element=database)

# download file from google drive
curl -L "${LINK}" --output ~/pantheon-local-copies/db/dump.sql.gz

# unzip pantheon backup
gunzip -d ~/pantheon-local-copies/db/dump.sql.gz

# delete current sql dump in local dev env
rm ~/dev/wcu/wcu-wp/.docker/mysql/dump.sql

# move unzipped pantheon backup into local dev env
mv ~/pantheon-local-copies/db/dump.sql ~/dev/wcu/wcu-wp/.docker/mysql/dump.sql

# shut down docker if running
cd $(echo $wcu_root)
docker-compose down -v
cd ${PWD}
