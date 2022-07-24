from PIL import Image, ImageDraw
im = Image.open("/var/www/laravel/download/yuma_temp.jpg")
draw = ImageDraw.Draw(im)
draw.rectangle([(0,0),(93,500)], fill=1, width=1)
draw.rectangle([(180,0),(500,500)], fill=1, width=1)
im.save('/var/www/laravel/download/yuma_temp_shironuri.jpg')
print("finish")
