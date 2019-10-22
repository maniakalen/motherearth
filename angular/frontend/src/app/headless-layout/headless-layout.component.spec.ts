import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { HeadlessLayoutComponent } from './headless-layout.component';

describe('HeadlessLayoutComponent', () => {
  let component: HeadlessLayoutComponent;
  let fixture: ComponentFixture<HeadlessLayoutComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ HeadlessLayoutComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(HeadlessLayoutComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
