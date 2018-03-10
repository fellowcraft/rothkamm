for file in /home/frank/rothkamm/ROTHKAMM/press/*.pdf
do
convert -thumbnail 200x $file $file.png
done
