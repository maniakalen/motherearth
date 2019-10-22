import { Component, OnInit } from '@angular/core';
import { HeaderService } from "../header.service";

@Component({
  selector: 'app-map',
  templateUrl: './map.component.html',
  styleUrls: ['./map.component.less']
})
export class MapComponent implements OnInit {
  title = 'My first AGM project';
  lat = 51.678418;
  lng = 7.809007;
  constructor() { }

  ngOnInit() {}

}
