<?= $this->extend('layouts/main') ?>
<?= $this->section('navigation') ?>
<?= $this->include('partials/dev/navigation') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?= $this->include('sections/dev-design-components/gallery') ?>
<?= $this->endSection() ?>
