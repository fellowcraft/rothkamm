for f in *.pdf; do \
convert "$f"[0] -thumbnail 280x280^ -gravity center -extent 280x280 "${f%.pdf}.jpg" \
; done

# convert -thumbnail x200 -background white -alpha remove 
