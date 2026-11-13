<?= $this->extend('layouts/main') ?>
<?= $this->section('navigation') ?>
<?= $this->include('dev/partials/navigation') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<?= $this->include('dev/sections/overview') ?>
<?= $this->endSection() ?>
