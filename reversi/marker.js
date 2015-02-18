function Marker (posX,posZ,color,voxel) {
    this.posX = posX;
    this.posZ = posZ;
	this.color = color;
	this.current = 1;
	this.markModel = new THREE.Mesh();
	this.construct(voxel);
}
Marker.prototype.construct(voxel){
	this.markModel = voxel;
}
Marker.prototype.setColor = function(color) {
    this.color = color;
};
Marker.prototype.getColor = function() {
    return this.color;
};
Marker.prototype.changeState = function() {
	if(current)
		current = 0;
};
Marker.prototype.transform = function() {
	if(color = "black")
	{
		setColor("white");
	}
	else
	{
		setColor("black");
	}
    return this.color;
};
