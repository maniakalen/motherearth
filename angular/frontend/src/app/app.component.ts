import {Component, OnInit} from '@angular/core';
import {LoadingService} from "./loading.service";
import {HeaderService} from "./header.service";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.less']
})
export class AppComponent  implements OnInit {
  title = 'frontend';
  loadingState = false;
  constructor(private loading: LoadingService, private header: HeaderService) { }

  ngOnInit() {
    this.loading.getSubject().subscribe(state => this.loadingState = state);
  }
}
