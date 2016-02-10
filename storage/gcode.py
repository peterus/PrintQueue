#!/bin/python
import math
import sys

def export_coordinate(elem):
	return float(elem[1:])

file = sys.argv[1]
homingspeed = 1500

abs_cord = False

x_cord = 0
y_cord = 0
z_cord = 0
e_cord = 0
f_rate = 0
old_x_cord = 0
old_y_cord = 0
old_z_cord = 0
old_e_cord = 0
old_f_rate = 0
delta_x_cord = 0
delta_y_cord = 0
delta_z_cord = 0
time = 0
delta_time = 0
dist = 0
delta_dist = 0

with open(file) as f:
	for line in f:
		delta_dist = 0
		delta_time = 0
		if line.startswith("G0") or line.startswith("G1"):
			for elem in line.split():
				if elem.startswith("X"):
					x_cord = export_coordinate(elem)
				if elem.startswith("Y"):
					y_cord = export_coordinate(elem)
				if elem.startswith("Z"):
					z_cord = export_coordinate(elem)
				if elem.startswith("E"):
					e_cord = export_coordinate(elem)
				if elem.startswith("F"):
					f_rate = export_coordinate(elem) / 60
			
			if abs_cord:
				delta_x_cord = x_cord - old_x_cord
				delta_y_cord = y_cord - old_y_cord
				delta_z_cord = z_cord - old_z_cord
				delta_e_cord = e_cord - old_e_cord
			else:
				delta_x_cord = x_cord
				delta_y_cord = y_cord
				delta_z_cord = z_cord
				delta_e_cord = e_cord
			
			delta_dist = math.sqrt(delta_x_cord * delta_x_cord + delta_y_cord * delta_y_cord + delta_z_cord * delta_z_cord)
			
			if delta_dist == 0:
				delta_time = abs(delta_e_cord) / f_rate;
			else:
				delta_time = delta_dist / f_rate
				#if old_f_rate == f_rate:
				#	delta_time = delta_dist / f_rate
				#	#print("time: " + str(time) + ", delta_time: " + str(delta_time) + ", delta_dist: " + str(delta_dist) + ", f_rate: " + str(f_rate))
				#else:
				#	accel = ((f_rate * f_rate) - (old_f_rate * old_f_rate)) / (2 * delta_dist)
				#	delta_time = (f_rate - old_f_rate) / accel
				
		elif line.startswith("G28"):
			x_cord = 0
			y_cord = 0
			delta_x_cord = x_cord - old_x_cord
			delta_y_cord = y_cord - old_y_cord
			delta_dist = math.sqrt(delta_x_cord * delta_x_cord + delta_y_cord * delta_y_cord)
			f_rate = homingspeed / 60
			delta_time = delta_dist / f_rate
			#print("delta_dist: " + str(delta_dist) + ", f_rate: " + str(f_rate) + ", delta_time: " + str(delta_time))
		
		elif line.startswith("G90"):
			abs_cord = True
		elif line.startswith("G91"):
			abs_cord = False
		
		#else:
		#	print(line)
		
		#print("dist: " + str(dist) + " delta: " + str(delta_dist))
		dist = dist + delta_dist
		time = time + delta_time
		old_x_cord = x_cord
		old_y_cord = y_cord
		old_z_cord = z_cord
		old_e_cord = e_cord
		old_f_rate = f_rate

print("Estimated print time: " + str(math.floor(time)) + " seconds or " + str(math.floor(time / 3600)) + " hours " + str(math.floor(math.fmod(time / 60, 60))) + " minutes")
