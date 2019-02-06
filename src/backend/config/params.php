<?php
return [
    'adminEmail' => 'admin@example.com',
	'menuItems' => [
		[
			'url' => null,
			'label' => Yii::t('app', 'Workflow config'),
			'visible' => function() { return \Yii::$app->user->can('maniakalen/workflow/view'); },
			'options' => ['class' => 'menu-item-workflows'],
			'items' => [
				[
					'url' => ['/workflow/admin/workflow-grid'],
					'id' => 'workflow-grid',
					'label' => Yii::t('app', 'Workflows'),
					'items' => [
						[
							'url' => ['workflow/admin/workflow-details'],
							'label' => Yii::t('app', 'Workflows details config'),
							'visible' => false,
							'id' => 'workflow-details'
						]
					]
				],
				[
					'url' => ['/workflow/admin/workflow-steps-grid'],
					'id' => 'workflow-steps-grid',
					'label' => Yii::t('app', 'Workflow steps'),
					'items' => [
						[
							'url' => ['/workflow/admin/workflow-step-details'],
							'label' => Yii::t('app', 'Workflows step details config'),
							'visible' => false,
							'id' => 'workflow-step-details'
						]
					]
				],
				[
					'url' => ['/workflow/admin/workflow-actions-grid'],
					'id' => 'workflow-actions-grid',
					'label' => Yii::t('app', 'Workflow actions'),
					'items' => [
						[
							'url' => ['/workflow/admin/workflow-action-details'],
							'label' => Yii::t('app', 'Workflows action details config'),
							'visible' => false,
							'id' => 'workflow-action-details'
						]
					]
				],
				[
					'url' => ['/workflow/admin/workflow-steps-actions-grid'],
					'id' => 'workflow-steps-actions-grid',
					'label' => Yii::t('app', 'Workflow step actions'),
					'items' => [
						[
							'url' => ['/workflow/admin/workflow-step-action-details'],
							'label' => Yii::t('app', 'Workflows action details config'),
							'visible' => false,
							'id' => 'workflow-step-action-details'
						]
					]
				],
			]
		]
	]
];
